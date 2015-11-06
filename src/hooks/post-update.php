<?php
/**
 * @link https://git-scm.com/docs/githooks#post-update
 *
 * This hook is invoked by git-receive-pack on the remote repository, which happens
 * when a git push is done on a local repository. It executes on the remote repository
 * once after all the refs have been updated.
 *
 * It takes a variable number of parameters, each of which is the name of ref that
 * was actually updated.
 *
 * This hook is meant primarily for notification, and cannot affect the outcome
 * of git-receive-pack.
 *
 * The post-update hook can tell what are the heads that were pushed, but it does
 * not know what their original and updated values are, so it is a poor place to do
 * log old..new. The post-receive hook does get both original and updated values of the refs.
 * You might consider it instead if you need them.
 *
 * When enabled, the default post-update hook runs git update-server-info to keep the
 * information used by dumb transports (e.g., HTTP) up-to-date. If you are publishing
 * a Git repository that is accessible via HTTP, you should probably enable this hook.
 *
 * Both standard output and standard error output are forwarded to git send-pack on
 * the other end, so you can simply echo messages for the user.
 */
