<?php
/**
 * @link  https://git-scm.com/docs/githooks#_pre_rebase
 *
 * This hook is called by git rebase and can be used to prevent a branch from
 * getting rebased. The hook may be called with one or two parameters.
 * The first parameter is the upstream from which the series was forked.
 * The second parameter is the branch being rebased, and is not set when rebasing
 * the current branch.
 */
