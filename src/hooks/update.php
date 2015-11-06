<?php
/**
 * @link https://git-scm.com/docs/githooks#update
 *
 * This hook is invoked by git-receive-pack on the remote repository, which happens
 * when a git push is done on a local repository. Just before updating the ref on the
 * remote repository, the update hook is invoked. Its exit status determines the success
 * or failure of the ref update.
 *
 * The hook executes once for each ref to be updated, and takes three parameters:
 * the name of the ref being updated,
 * the old object name stored in the ref,
 * and the new object name to be stored in the ref.
 *
 * A zero exit from the update hook allows the ref to be updated. Exiting with a
 * non-zero status prevents git-receive-pack from updating that ref.
 *
 * This hook can be used to prevent forced update on certain refs by making sure that
 * the object name is a commit object that is a descendant of the commit object named
 * by the old object name. That is, to enforce a "fast-forward only" policy.
 *
 * It could also be used to log the old..new status. However, it does not know the
 * entire set of branches, so it would end up firing one e-mail per ref when used naively,
 * though. The post-receive hook is more suited to that.
 *
 * Another use suggested on the mailing list is to use this hook to implement access
 * control which is finer grained than the one based on filesystem group.
 *
 * Both standard output and standard error output are forwarded to git send-pack on
 * the other end, so you can simply echo messages for the user.
 *
 * The default update hook, when enabled—​and with hooks.allowunannotated config option
 * unset or set to false—​prevents unannotated tags to be pushed.
 */
