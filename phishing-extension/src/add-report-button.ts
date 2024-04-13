
/**
 * Called after the page is fully loaded.
 * @returns true if successful
 */
export function addReportButtonToSite(): boolean {
    const parentDiv = document.getElementById("1-panel");
    if (!parentDiv) {
        return false
    }

    const button = document.createElement('a')
    button.setAttribute("href", "http://aschaef1.w3.uvm.edu/Phishing/form.php")
    button.setAttribute("id", "innerRibbonContainer")
    button.setAttribute("target", "_blank")
    button.innerHTML = "Report Phishing"
    button.classList.add("groupContainer-186")

    parentDiv.appendChild(button)

    return true
}
