<?php
function render_template(string $template, array $vars = []): void {
    extract($vars);
    include __DIR__ . '/templates/' . $template . '.php';
}
?>
