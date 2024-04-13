
async function grab() {
	let result = null
	let backoff = 10; // ms
	while (!result) {
		await Promise.resolve(async () => {
			console.log("Waiting " + backoff)
			await setTimeout(res, backoff)
		})

		result = false
		if (result) {
			alert("Found the item")
			return result
		} else {
			backoff *= 2
		}
	}
	return result
}

grab()
