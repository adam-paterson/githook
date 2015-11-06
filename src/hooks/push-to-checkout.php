<?php
/**
 * @link https://git-scm.com/docs/githooks#_push_to_checkout
 *
 * This hook is invoked by git-receive-pack on the remote repository, which happens
 * when a git push is done on a local repository, when the push tries to update the
 * branch that is currently checked out and the receive.denyCurrentBranch configuration
 * variable is set to updateInstead. Such a push by default is refused if the working
 * tree and the index of the remote repository has any difference from the currently
 * checked out commit; when both the working tree and the index match the current commit,
 * they are updated to match the newly pushed tip of the branch. This hook is to be
 * used to override the default behaviour.
 *
 * The hook receives the commit with which the tip of the current branch is going to
 * be updated. It can exit with a non-zero status to refuse the push (when it does so,
 * it must not modify the index or the working tree). Or it can make any necessary
 * changes to the working tree and to the index to bring them to the desired state
 * when the tip of the current branch is updated to the new commit, and exit with a
 * zero status.
 *
 * For example, the hook can simply run git read-tree -u -m HEAD "$1" in order to
 * emulate git fetch that is run in the reverse direction with git push, as the
 * two-tree form of read-tree -u -m is essentially the same as git checkout that
 * switches branches while keeping the local changes in the working tree that do not
 * interfere with the difference between the branches.
 */
