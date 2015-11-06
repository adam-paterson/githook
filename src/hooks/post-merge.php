<?php
/**
 * @link https://git-scm.com/docs/githooks#_post_merge
 *
 * This hook is invoked by git merge, which happens when a git pull is done on a
 * local repository. The hook takes a single parameter, a status flag specifying
 * whether or not the merge being done was a squash merge. This hook cannot affect
 * the outcome of git merge and is not executed, if the merge failed due to conflicts.
 *
 * This hook can be used in conjunction with a corresponding pre-commit hook to
 * save and restore any form of metadata associated with the working
 * tree (e.g.: permissions/ownership, ACLS, etc). See contrib/hooks/setgitperms.perl
 * for an example of how to do this.
 */
