<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link to=/ class=navbar-brand>Navbar</router-link>
        <button class=navbar-toggler type=button data-toggle=collapse data-target=#navbarSupportedContent aria-controls=navbarSupportedContent aria-expanded=false aria-label="Toggle navigation">
            <span class=navbar-toggler-icon></span>
        </button>

        <div class="collapse navbar-collapse" id=navbarSupportedContent>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link to=/home class=nav-link>Home</router-link>
                </li>
                <li class=nav-item>
                    <router-link to=/login class=nav-link>Login</router-link>
                </li>
                <li class=nav-item>
                    <router-link to=/register class=nav-link>Register</router-link>
                </li>
            </ul>
        </div>
        </nav>
</template>
