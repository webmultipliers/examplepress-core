<?php

?>

<!-- HERO -->
<div class="hero">
	<div class="hero-tag">Private Beta</div>

	<h1 class="section-headline">Dev by <em>Example.</em></h1>

	<p class="section-body">
		ExamplePress is a growing suite of resources for modern WordPress developers. We provide the
		<strong>architecture, the code, and the philosophy</strong> to help you build better block themes
		without the FSE headaches.
	</p>

	<div class="hero-actions">
		<a href="#apply" class="btn btn-primary">Apply for the Private Beta</a>
		<span class="hero-note">// No commitment.</span>
	</div>

</div>

<!-- STACK -->
<section class="stack-section">
	<div class="container">
		<div class="section-label reveal">The Stack</div>
		<div class="stack-header reveal">
			<h2>Three layers. One vision.</h2>
			<p>ExamplePress replaces the traditional WordPress template hierarchy with a clean, code-first architecture
				that keeps your layouts in version control.</p>
		</div>

		<div class="stack-grid">
			<div class="stack-card reveal">
				<div class="card-eyebrow">Layer 01 &mdash; Router</div>
				<h3>ExamplePress</h3>
				<p>A single-entry-point router that bypasses FSE entirely. Your templates stay in PHP files, not the
					database.</p>
				<ul class="stack-features">
					<li>Single-entry-point routing</li>
					<li>Context-aware template resolution</li>
					<li>No FSE dependency</li>
					<li>Full PHP template control</li>
				</ul>
			</div>

			<div class="stack-card reveal" style="transition-delay:0.1s">
				<div class="card-eyebrow">Layer 02 &mdash; Templating</div>
				<h3>Blockstudio</h3>
				<p>Define blocks with <code>block.json</code> + pure PHP. No React, no JSX, no build step. Just
					attributes and templates.</p>
				<ul class="stack-features">
					<li>JSON schema block definitions</li>
					<li>Pure PHP render templates</li>
					<li>Inline SCSS compilation</li>
					<li>Zero JavaScript required</li>
				</ul>
			</div>

			<div class="stack-card reveal" style="transition-delay:0.2s">
				<div class="card-eyebrow">Layer 03 &mdash; Distribution</div>
				<h3>Troy</h3>
				<p>Private plugin &amp; theme distribution via Composer. Push once, update everywhere across your client
					fleet.</p>
				<ul class="stack-features">
					<li>Private Composer repository</li>
					<li>Semantic versioning</li>
					<li>Fleet-wide updates</li>
					<li>License key management</li>
				</ul>
			</div>
		</div>
	</div>
</section>



<!-- FOOTER -->
<footer class="footer">
	<span class="footer-left">&copy; <?= date( 'Y' ) ?> ExamplePress. All rights reserved.</span>
	<div class="footer-right">
		<a href="mailto:hello@examplepress.com">hello@examplepress.com</a>
	</div>
</footer>