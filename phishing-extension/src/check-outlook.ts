// Ran when outlook is loaded

import { addReportButtonToSite } from "./add-report-button";
import { queryReportedPhishes } from "./query";

init();

const WARNING_MESSAGE_VIEW = document.createElement('p')
WARNING_MESSAGE_VIEW.innerText = "This email matches a known phish."
WARNING_MESSAGE_VIEW.style.display = "none"
WARNING_MESSAGE_VIEW.style.padding = "1em"
WARNING_MESSAGE_VIEW.style.backgroundColor = "red"
WARNING_MESSAGE_VIEW.style.width = "100%"
WARNING_MESSAGE_VIEW.style.margin = "0"

/**
 * Grabs the compose pane by its id. Uses exponential backoff because
 * the page takes some time to load/ this might not be the right page.
 */
async function grabComposePane(): Promise<HTMLDivElement | null> {
  let result: HTMLDivElement | null = null;

  let counter = 0;
  let loadingBackoff: Promise<HTMLDivElement> = new Promise((res, rej) => {
    let backoffInterval = setInterval(() => {
      counter++;
      if (counter >= 60) {
        rej(new Error("Page not loading"));
      }

      result = document.getElementById(
        "ConversationReadingPaneContainer",
      ) as HTMLDivElement;
      if (result) {
        res(result);
      }
    }, 100);
  });

  try {
    return await loadingBackoff;
  } catch (e) {
    console.log("Page not found");
    return null;
  }
}

let composePaneSwitchedTimout: number | null = null;

async function init(): Promise<void> {
  const composePane = await grabComposePane();
  if (!composePane) {
    alert("Failed to load extension");
    return;
  }
  const body = document.getElementsByTagName("body")[0]
  body.prepend(WARNING_MESSAGE_VIEW)

  addReportButtonToSite()

  const config = { attributes: true, childList: true, subtree: true };
  const observer = new MutationObserver(() => {
    if (composePaneSwitchedTimout) {
      clearTimeout(composePaneSwitchedTimout)
    }

    // @ts-ignore
    composePaneSwitchedTimout = setTimeout(() => {
      composePaneSwitchedTimout = null
      checkPaneForPhish(composePane)
    }, 500)
  });
  observer.observe(composePane, config);
  
  checkPaneForPhish(composePane)
}

/**
  * Displays a warning for potential phish.
  */
async function showWarning(composePane: HTMLDivElement, show: boolean): Promise<void> {
  composePane.style.transitionDuration = "500ms"
  if (show) {
    composePane.style.backgroundColor = "red"
    WARNING_MESSAGE_VIEW.style.display = "block"
  } else {
    composePane.style.backgroundColor = "transparent"
    WARNING_MESSAGE_VIEW.style.display = "none"
  }
}

let cachedPhishes: string[]
let lastRequest = 0

async function checkPaneForPhish(composePane: HTMLDivElement) {
  if (Date.now() - lastRequest > 36000000) {
    cachedPhishes = await queryReportedPhishes()
    lastRequest = Date.now()
  }

  // Search pane content for phish content
  for (const phish of cachedPhishes) {
    const emailContent = composePane.innerHTML
    if (emailContent.indexOf(phish) != -1) {
      showWarning(composePane, true)
      return
    }
  }
  showWarning(composePane, false)
}

