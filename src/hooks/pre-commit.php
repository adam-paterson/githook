<?php
/**
 * @link https://git-scm.com/docs/githooks#_pre_commit
 *
 * This hook is invoked by git commit, and can be bypassed with --no-verify option.
 * It takes no parameter, and is invoked before obtaining the proposed commit log
 * message and making a commit. Exiting with non-zero status from this script
 * causes the git commit to abort.
 *
 * The default pre-commit hook, when enabled, catches introduction of lines with
 * trailing whitespaces and aborts the commit when such a line is found.
 *
 * All the git commit hooks are invoked with the environment variable GIT_EDITOR=:
 * if the command will not bring up an editor to modify the commit message.
 */
