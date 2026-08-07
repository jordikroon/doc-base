<?php

declare(strict_types=1);

namespace PhpDoc\Dev\Environment;

/**
 * Where builds run: inside the Docker image, or with the local PHP.
 * Commands describe what to run; the environment maps paths and executes.
 */
interface Environment
{
    /**
     * Whether a doc-<lang> checkout can be presented under its language
     * name without touching the filesystem (Docker mounts can).
     */
    public function canMapDirectoryNames(): bool;

    /** @param list<string> $args configure.php arguments */
    public function configure(string $lang, array $args): int;

    /** @param string $docbook Manual file name inside doc-base, e.g. ".manual.xml". */
    public function render(string $lang, string $docbook, string $format): int;

    /** @param list<string> $args docbook-cs arguments; runs in the language directory */
    public function lint(string $lang, array $args): int;

    /** @param string $subdir Path inside <lang>/output to use as web root, or "". */
    public function serve(string $lang, int $port, string $subdir): int;

    public function shell(string $lang): int;

    public function buildImage(): int;
}
