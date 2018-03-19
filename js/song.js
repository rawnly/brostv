(function() {
	// myAudio = new Audio(`/assets/songs/background-${randomSong()}.wav`);
	// myAudio.addEventListener('ended', function() {
	// 	this.currentTime = 0;
	// 	this.play();
	// }, false);

	// myAudio.play();
})()

function randomSong() {
	var n = [0, 1];
	return n[Math.floor(Math.random() * n.length)];
}