const root = document.documentElement;
const storedTheme = localStorage.getItem('theme');
const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');
const prefersDark = systemTheme.matches;

if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
    root.classList.add('dark');
}

function syncThemeButtons() {
    const isDark = root.classList.contains('dark');

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        const label = isDark ? 'Passer au mode clair' : 'Passer au mode sombre';
        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
    });
}

document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        root.classList.toggle('dark');
        localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
        syncThemeButtons();
    });
});

systemTheme.addEventListener('change', (event) => {
    if (localStorage.getItem('theme')) {
        return;
    }

    root.classList.toggle('dark', event.matches);
    syncThemeButtons();
});

syncThemeButtons();

document.querySelectorAll('[data-mobile-menu-toggle]').forEach((button) => {
    const target = document.getElementById(button.dataset.mobileMenuToggle);

    if (!target) {
        return;
    }

    button.addEventListener('click', () => {
        target.classList.toggle('hidden');
        button.setAttribute('aria-expanded', target.classList.contains('hidden') ? 'false' : 'true');
    });
});

document.querySelectorAll('[data-mobile-menu-close]').forEach((button) => {
    const target = document.getElementById(button.dataset.mobileMenuClose);

    if (!target) {
        return;
    }

    button.addEventListener('click', () => {
        target.classList.add('hidden');
        document.querySelectorAll(`[data-mobile-menu-toggle="${target.id}"]`).forEach((toggle) => {
            toggle.setAttribute('aria-expanded', 'false');
        });
    });
});

const UserMenuBtn = document.getElementById('dropdown-user-open-menu')
const UserMenu = document.getElementById('dropdown-user-menu')

if (UserMenuBtn && UserMenu) {
    UserMenuBtn.addEventListener('click', function() {
        UserMenu.classList.toggle('hidden');
    })
}

const SideBarBtn = document.getElementById('sidebar-humberger')
const SideBar = document.getElementById('logo-sidebar')

if (SideBarBtn && SideBar) {
    SideBarBtn.addEventListener('click', function(){
        SideBar.classList.toggle('-translate-x-full')
    })
}
