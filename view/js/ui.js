const toggleBtnRender = document.getElementById('toggle-nav-btn');
const navContent = document.getElementById('nav-content');
const mainContent = document.getElementById('main-content');
toggleBtnRender.addEventListener('click', toggleBtnHandller);

function toggleBtnHandller(e){
	navContent.classList.toggle('show');
	toggleBtnHandller.style.backgroundColor = '#1261ea';
	// remove event listener
}