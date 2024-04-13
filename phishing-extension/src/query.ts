
/**
 * Gets a list of phish email contents
 */
export async function queryReportedPhishes(): Promise<string[]> {
  try {
    const response = await fetch(
      "http://aschaef1.w3.uvm.edu/Phishing/process.php",
      {
        method: "GET",
        mode: "cors",
        headers: {
          "Access-Control-Allow-Origin": "*",
        },
      },
    );
    const result = await response.json()
    return result
  } catch (e) {
    console.log(e);
  }
  return [] 
}
