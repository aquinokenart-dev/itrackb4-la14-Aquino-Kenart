Lab # 14

F1 Authentication and authorisation are not the same. In one sentence each: what did this lesson give you, and what is still missing next meeting?
-Authentication (proving who someone is) is what this lesson gave me: register, login and logout. Authorisation (what that person may do) is still missing, because any signed-in user can edit or delete any movie.

F2 Why does a successful login call session()->regenerate()? What goes wrong if you skip it?
-A successful login calls session()->regenerate() to give the user a new session id. If I skip it, an attacker who planted a known session id before login can reuse it afterwards (session fixation).

F3 Why does a failed login use the same message for a wrong password and an unknown email?
-A wrong password and an unknown email give the same message so a stranger can't use my login page to find out which emails are registered.

F4 Why do index and show stay public while create/edit/update/destroy use auth?
-index and show stay public so guests can browse the catalogue. Only the actions that change data (create, store, edit, update, destroy) use auth.

F5 You hid Add (and actions) for guests. Why is that not enough to secure those actions? What actually stops a stranger?
-Hiding Add and the actions only changes what's displayed; the URLs still exist, as screenshot 19 shows. What actually stops a stranger is the auth middleware on those routes.

F6 In screenshot 20 the route name was wrong. Why does auth middleware care that the route is named exactly login?
-When auth rejects a guest, it redirects to route('login'). If no route has that exact name, Laravel throws "Route [login] not defined", as screenshot 20 shows.