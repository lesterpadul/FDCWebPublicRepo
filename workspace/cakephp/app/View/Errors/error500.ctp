<h1>Internal Server Error (500)</h1>

<p>The server encountered an unexpected error that prevented it from fulfilling your request.</p>

<p>We apologize for any inconvenience this may cause.  Our team is working to resolve the issue as soon as possible.</p>

<?php if (Configure::read('debug') > 0) : ?>
  <p>**Debug Information (for developers only):**</p>
  <pre><?= h($message) ?></pre>
<?php endif; ?>