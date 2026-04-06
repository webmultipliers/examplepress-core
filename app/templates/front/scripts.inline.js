import "npm:bootstrap@5.3.8/dist/css/bootstrap-grid.min.css";

// Scroll reveal
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
	entries.forEach(e => {
		if (e.isIntersecting) {
			e.target.classList.add('visible');
			observer.unobserve(e.target);
		}
	});
}, { threshold: 0.12 });
reveals.forEach(el => observer.observe(el));

