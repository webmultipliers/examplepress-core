// Data definitions for nodes
const nodeData = {
	'node-github-src': {
		title: 'GitHub Source Code',
		badge: 'Source Control',
		quadColor: 'var(--q1-color)',
		desc: 'The genesis point. Developers write native code for the Core OS, Theme, and individual modular apps here.',
		actions: [
			'Codebase authored natively.',
			'Commits trigger tags and releases.'
		]
	},
	'node-gh-releases': {
		title: 'GitHub Releases',
		badge: 'Artifacts',
		quadColor: 'var(--q1-color)',
		desc: 'The single source of truth for versioned code. This generates packaged zip files that feed into downstream distribution networks.',
		actions: [
			'Creates immutable release artifacts.',
			'Feeds app updates into Troy.',
			'Feeds core updates to direct updaters.'
		]
	},
	'node-updaters': {
		title: 'Direct Updaters',
		badge: 'Core Distribution',
		quadColor: 'var(--q2-color)',
		desc: 'Bypasses standard WordPress update mechanics to pull critical OS-level infrastructure directly from GitHub Releases.',
		actions: [
			'Pulls MU Kernel updates automatically.',
			'Pulls Theme Router via standalone updater.',
			'Survives application-level fatal errors.'
		]
	},
	'node-troy': {
		title: 'Troy Server',
		badge: 'App Distribution',
		quadColor: 'var(--q2-color)',
		desc: 'The fleet management hub. It brings in GitHub releases specifically for the application layer and distributes them to connected sites.',
		actions: [
			'Ingests shared modular App releases.',
			'Manages client fleet license verification.',
			'Pushes updates to the Application Layer.'
		]
	},
	'node-mu': {
		title: 'Kernel (MU Plugin)',
		badge: 'examplepress-mu',
		quadColor: 'var(--q3-color)',
		desc: 'The self-updating brain. Crucially, it bundles the Blockstudio experience and delivers those rendering capabilities to the Theme.',
		actions: [
			'Bundles the zero-build Blockstudio engine.',
			'Delivers capabilities to the Theme Router.',
			'Provides governance and app validation.'
		]
	},
	'node-theme': {
		title: 'Theme Router Block',
		badge: 'examplepress-theme',
		quadColor: 'var(--q3-color)',
		desc: 'A minimal, single-entry theme holding the Router Block. It contains zero standalone templates; it strictly relies on Modular Apps to provide and fulfill all routes.',
		actions: [
			'Receives WP execution from Web Server.',
			'Matches request against App-injected routes.',
			'Delegates 100% of rendering to the App Layer.'
		]
	},
	'node-apps': {
		title: 'Modular Apps',
		badge: 'Plugins Layer',
		quadColor: 'var(--q4-color)',
		desc: 'The actual fulfillment layer. Apps register their available routes with the Theme, catch the resulting delegates, and handle their own JS/SCSS with zero build processes.',
		actions: [
			'Supplies valid routes to the Theme Router.',
			'Fulfills active delegates with native UI.',
			'Returns final rendered blocks to the Theme.'
		]
	},
	'node-server': {
		title: 'Production Web Server',
		badge: 'Gateway',
		quadColor: '#ec4899',
		desc: 'The true frontline (Nginx/Apache). The end user interacts exclusively with this server. It handles initial routing, SSL, and caching before waking up WordPress.',
		actions: [
			'Receives raw HTTP request from User.',
			'Terminates SSL and serves static assets.',
			'Passes dynamic traffic to WP / Theme Router.'
		]
	},
	'node-user': {
		title: 'End User / Browser',
		badge: 'Client',
		quadColor: '#ec4899',
		desc: 'The final consumer. They interact with the server via browser and never touch the apps or theme directly.',
		actions: [
			'Issues HTTP Request to the Web Server.',
			'Receives the fully assembled HTML payload.',
			'Experiences highly optimized, routed architecture.'
		]
	}
};

// Define connections: Updates vs Requests
const connections = [
	// Code Pipeline
	{ from: 'node-github-src', to: 'node-gh-releases', flowClass: 'flow-q1' },
	{ from: 'node-gh-releases', to: 'node-troy', flowClass: 'flow-mixed' },
	{ from: 'node-gh-releases', to: 'node-updaters', flowClass: 'flow-mixed' },
	{ from: 'node-troy', to: 'node-apps', flowClass: 'flow-q2' },
	{ from: 'node-updaters', to: 'node-mu', flowClass: 'flow-q2' },
	{ from: 'node-updaters', to: 'node-theme', flowClass: 'flow-q2' },

	// Capability Delivery
	{ from: 'node-mu', to: 'node-theme', flowClass: 'flow-q3' }, // Bundles Blockstudio

	// Web Request Lifecycle (Pink Path)
	{ from: 'node-user', to: 'node-server', flowClass: 'flow-req' },
	{ from: 'node-server', to: 'node-theme', flowClass: 'flow-req' }, // Server hits WP/Router
	{ from: 'node-theme', to: 'node-apps', flowClass: 'flow-req' } // Router delegates to Apps
];

const svgLayer = document.getElementById('svg-layer');
const infoContent = document.getElementById('info-content');
const allNodes = document.querySelectorAll('.node');

let pathElements = [];

// Function to draw SVG paths
function drawPipes() {
	svgLayer.innerHTML = '';
	pathElements = [];
	const svgRect = svgLayer.getBoundingClientRect();

	connections.forEach(conn => {
		const elFrom = document.getElementById(conn.from);
		const elTo = document.getElementById(conn.to);

		if (!elFrom || !elTo) return;

		const rectFrom = elFrom.getBoundingClientRect();
		const rectTo = elTo.getBoundingClientRect();

		// Calculate centers relative to SVG container
		const x1 = rectFrom.left + rectFrom.width / 2 - svgRect.left;
		const y1 = rectFrom.top + rectFrom.height / 2 - svgRect.top;
		const x2 = rectTo.left + rectTo.width / 2 - svgRect.left;
		const y2 = rectTo.top + rectTo.height / 2 - svgRect.top;

		// Adjust curve logic slightly for layout
		const isVertical = Math.abs(y1 - y2) > Math.abs(x1 - x2);
		let d = '';

		if (isVertical) {
			const midY = (y1 + y2) / 2;
			d = `M ${x1} ${y1} C ${x1} ${midY}, ${x2} ${midY}, ${x2} ${y2}`;
		} else {
			const midX = (x1 + x2) / 2;
			d = `M ${x1} ${y1} C ${midX} ${y1}, ${midX} ${y2}, ${x2} ${y2}`;
		}

		// Base pipe
		const basePipe = document.createElementNS('http://www.w3.org/2000/svg', 'path');
		basePipe.setAttribute('d', d);
		basePipe.setAttribute('class', 'pipe');

		// Flow pipe (animated dashes)
		const flowPipe = document.createElementNS('http://www.w3.org/2000/svg', 'path');
		flowPipe.setAttribute('d', d);
		flowPipe.setAttribute('class', `pipe-flow ${conn.flowClass}`);
		flowPipe.dataset.from = conn.from;
		flowPipe.dataset.to = conn.to;

		svgLayer.appendChild(basePipe);
		svgLayer.appendChild(flowPipe);
		pathElements.push(flowPipe);
	});
}

window.addEventListener('resize', drawPipes);
setTimeout(drawPipes, 100);

// Interaction Logic
allNodes.forEach(node => {
	node.addEventListener('mouseenter', () => {
		const id = node.id;

		// Highlight node
		allNodes.forEach(n => n.classList.remove('active'));
		node.classList.add('active');

		// Check if this node is part of the request lifecycle
		const isRequestNode = ['node-user', 'node-server', 'node-theme', 'node-apps'].includes(id);

		// Highlight connected pipes
		pathElements.forEach(pipe => {
			const pipeFrom = pipe.dataset.from;
			const pipeTo = pipe.dataset.to;

			// If hovering over a request lifecycle node, light up the whole request pipeline
			if (isRequestNode && ['node-user', 'node-server', 'node-theme', 'node-apps'].includes(pipeFrom) && ['node-server', 'node-theme', 'node-apps'].includes(pipeTo)) {
				pipe.classList.add('active');
				// Make delegation bidirectional illusion
				if (pipeFrom === 'node-theme' && pipeTo === 'node-apps' && id === 'node-apps') {
					pipe.classList.add('reverse');
				} else if (pipeFrom === 'node-server' && pipeTo === 'node-theme' && id === 'node-theme') {
					pipe.classList.add('reverse');
				} else if (pipeFrom === 'node-user' && pipeTo === 'node-server' && id === 'node-server') {
					pipe.classList.add('reverse');
				}
			}
			// Otherwise just standard adjacent highlighting
			else if (pipeFrom === id || pipeTo === id) {
				pipe.classList.add('active');
			} else {
				pipe.classList.remove('active');
				pipe.style.opacity = '0.05'; // Dim others significantly
			}
		});

		// Update Info Panel
		const data = nodeData[id];
		if (data) {
			let actionsHtml = data.actions.map(act => `<li>${act}</li>`).join('');
			let badgeColor = data.quadColor === '#ec4899' ? '#ec4899' : data.quadColor;

			infoContent.innerHTML = `
                        <div class="badge" style="background-color: ${badgeColor}22; color: ${badgeColor}; border: 1px solid ${badgeColor}55;">
                            ${data.badge}
                        </div>
                        <h2 id="info-title">${data.title}</h2>
                        <p id="info-desc">${data.desc}</p>
                        <ul class="action-list" style="--q1-color: ${badgeColor}">
                            ${actionsHtml}
                        </ul>
                    `;
		}
	});

	node.addEventListener('mouseleave', () => {
		node.classList.remove('active');

		pathElements.forEach(pipe => {
			pipe.classList.remove('active');
			pipe.classList.remove('reverse');
			pipe.style.opacity = '0.4';
		});
	});
});