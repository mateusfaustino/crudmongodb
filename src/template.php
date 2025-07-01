<?php
function renderTemplate(string $template, array $vars = []): void {
    extract($vars);
    include __DIR__ . '/templates/' . $template . '.php';
}
?>
