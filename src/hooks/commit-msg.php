<?php
/**
 * @link https://git-scm.com/docs/githooks#_commit_msg
 *
 * This hook is invoked by git commit, and can be bypassed with --no-verify option.
 * It takes a single parameter, the name of the file that holds the proposed
 * commit log message. Exiting with non-zero status causes the git commit to abort.
 *
 * The hook is allowed to edit the message file in place, and can be used to
 * normalize the message into some project standard format (if the project has one).
 * It can also be used to refuse the commit after inspecting the message file.
 *
 * The default commit-msg hook, when enabled, detects duplicate "Signed-off-by"
 * lines, and aborts the commit if one is found.
 */
