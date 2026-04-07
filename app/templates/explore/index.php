<div id="main-container">
	<header>
		<h1>ExamplePress Architecture</h1>
		<p>Hover over components to trace source code updates and the frontend request lifecycle.</p>
	</header>

	<div id="grid-wrapper">
		<svg id="svg-layer"></svg>

		<div id="quadrants">
			<!-- Q1: Source & Creation -->
			<div class="quadrant q1">
				<div class="quadrant-label">1. Source & Creation</div>
				<div class="nodes-container">
					<div class="node" id="node-github-src" data-quad="1">
						<h3>GitHub Source</h3>
						<p>Author & Commit Code</p>
					</div>
					<div class="node" id="node-gh-releases" data-quad="1">
						<h3>GitHub Releases</h3>
						<p>Versioned Artifacts</p>
					</div>
				</div>
			</div>

			<!-- Q2: Distribution -->
			<div class="quadrant q2">
				<div class="quadrant-label">2. Distribution Channels</div>
				<div class="nodes-container">
					<div class="node" id="node-updaters" data-quad="2">
						<h3>Direct Updaters</h3>
						<p>Pulls Core OS Updates</p>
					</div>
					<div class="node" id="node-troy" data-quad="2">
						<h3>Troy Server</h3>
						<p>Brings in App Releases</p>
					</div>
				</div>
			</div>

			<!-- Q3: Core OS -->
			<div class="quadrant q3">
				<div class="quadrant-label">3. Platform Core</div>
				<div class="nodes-container">
					<div class="node" id="node-mu" data-quad="3">
						<h3>Kernel (MU Plugin)</h3>
						<p>Bundles Blockstudio</p>
					</div>
					<div class="node" id="node-theme" data-quad="3">
						<h3>Theme Router</h3>
						<p>Application Gateway</p>
					</div>
				</div>
			</div>

			<!-- Q4: App Layer & Delivery -->
			<div class="quadrant q4">
				<div class="quadrant-label">4. Application Layer & Delivery</div>
				<div class="nodes-container" style="align-items: flex-start; margin-top: 20px;">
					<div class="node" id="node-apps" data-quad="4">
						<h3>Modular Apps</h3>
						<p>Fulfills Routes & Logic</p>
					</div>
					<div style="display: flex; flex-direction: column; gap: 20px;">
						<div class="node edge-node" id="node-server" data-quad="4">
							<h3>Web Server (Nginx)</h3>
							<p>HTTP/SSL Frontline</p>
						</div>
						<div class="node edge-node" id="node-user" data-quad="4">
							<h3>End User</h3>
							<p>Browser Request</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="info-panel">
		<h2>Architecture Details</h2>
		<div id="info-content">
			<div class="empty-state">Hover over a node in the grid to view its role and lifecycle pipelines.</div>
		</div>
		<div class="legend">
			<div class="legend-item">
				<div class="legend-dot" style="background: var(--text-muted);"></div> Code / Updates
			</div>
			<div class="legend-item">
				<div class="legend-dot" style="background: #ec4899;"></div> Web Request Lifecycle
			</div>
		</div>
	</div>

</div>