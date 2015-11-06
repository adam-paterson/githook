<?php
/**
 * @link https://git-scm.com/docs/githooks#_applypatch_msg
 *
 * This hook is invoked by git am script. It takes a single parameter, the name of
 * the file that holds the proposed commit log message.
 * Exiting with non-zero status causes git am to abort before applying the patch.
 *
 * The hook is allowed to edit the message file in place, and can be used to
 * normalize the message into some project standard format (if the project has one).
 * It can also be used to refuse the commit after inspecting the message file.
 *
 * The default applypatch-msg hook, when enabled, runs the commit-msg hook,
 * if the latter is enabled.
 */
