// Ran when outlook is loaded

import { queryReportedPhishes } from "./query";

init();

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
        "Skip to message-region",
      ) as HTMLDivElement;
      if (result) {
        res(result);
      }
    }, 1000);
  });

  try {
    return await loadingBackoff;
  } catch (e) {
    console.log("Page not found");
    return null;
  }
}

async function init(): Promise<void> {
  const composePane = await grabComposePane();
  if (!composePane) {
    alert("failed to load extension");
    return;
  }

  const config = { attributes: true, childList: true, subtree: true };

  const observer = new MutationObserver(checkPaneForPhish);

  observer.observe(composePane, config);
  checkPaneForPhish()

  // fetch("http://aschaef1.w3.uvm.edu/Phishing/form.php");

  // Later, you can stop observing
  // observer.disconnect();

}

let cachedPhishes: string[]
let lastRequest = 0

async function checkPaneForPhish() {
  if (Date.now() - lastRequest > 36000000) {
    cachedPhishes = await queryReportedPhishes()
    lastRequest = Date.now()
  }



  // Search pane content for phish content
  for (const phish of cachedPhishes) {
    console.log("Checking for " + phish)
  }

}

