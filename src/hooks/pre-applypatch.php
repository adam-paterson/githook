<?php
/**
 * @link https://git-scm.com/docs/githooks#_post_applypatch
 *
 * This hook is invoked by git am. It takes no parameter, and is invoked after the
 * patch is applied, but before a commit is made.
 *
 * If it exits with non-zero status, then the working tree will not be committed
 * after applying the patch.
 *
 * It can be used to inspect the current working tree and refuse to make a commit
 * if it does not pass certain test.
 *
 * The default pre-applypatch hook, when enabled, runs the pre-commit hook,
 * if the latter is enabled.
 */
