<?php
/**
 * @link https://git-scm.com/docs/githooks#post-receive
 *
 * This hook is invoked by git-receive-pack on the remote repository, which happens
 * when a git push is done on a local repository. It executes on the remote repository
 * once after all the refs have been updated.
 *
 * This hook executes once for the receive operation. It takes no arguments, but gets
 * the same information as the pre-receive hook does on its standard input.
 *
 * This hook does not affect the outcome of git-receive-pack, as it is called after
 * the real work is done.
 *
 * This supersedes the post-update hook in that it gets both old and new values of
 * all the refs in addition to their names.
 *
 * Both standard output and standard error output are forwarded to git send-pack on
 * the other end, so you can simply echo messages for the user.
 *
 * The default post-receive hook is empty, but there is a sample script post-receive-email
 * provided in the contrib/hooks directory in Git distribution, which implements
 * sending commit emails.
 */
