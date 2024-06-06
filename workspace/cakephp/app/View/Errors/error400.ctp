<h1>Bad Request (400)</h1>

<p>Your request could not be understood by the server due to invalid syntax. This could be caused by:</p>

<ul>
  <li>Malformed data in your request (e.g., missing required parameters, invalid data types).</li>
  <li>Incorrect URL formatting.</li>
  <li>Issues with your request headers.</li>
</ul>

<p>Please check your request and try again.</p>

<?php if (isset($debugInfo)) : ?>
  <p>**Debug Information (for developers only):**</p>
  <pre><?= h($debugInfo) ?></pre>
<?php endif; ?>