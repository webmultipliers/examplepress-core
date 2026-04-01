// --- Scroll Reveal ---
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
	entries.forEach(entry => {
		if (entry.isIntersecting) {
			entry.target.classList.add('visible');
		}
	});
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

reveals.forEach(el => observer.observe(el));

// --- Form submit handler ---
function handleSubmit(e) {
	e.preventDefault();
	const btn = document.getElementById('submitBtn');

	btn.textContent = 'Submitting...';
	btn.style.opacity = '0.8';

	setTimeout(() => {
		btn.textContent = 'Submitted \u2713';
		btn.style.background = 'var(--green)';
		btn.style.borderColor = 'var(--green)';
		btn.style.opacity = '1';
		btn.disabled = true;
	}, 800);
}

// --- Subtle parallax on hero code block ---
const codeBlock = document.querySelector('.code-split');
window.addEventListener('scroll', () => {
	const scroll = window.scrollY;
	if (codeBlock && scroll < window.innerHeight) {
		codeBlock.style.transform = `translateY(${scroll * 0.04}px)`;
	}
}, { passive: true });