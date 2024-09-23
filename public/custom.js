const UserMenuBtn = document.getElementById('dropdown-user-open-menu')
const UserMenu = document.getElementById('dropdown-user-menu')

UserMenuBtn.addEventListener('click', function() {
    UserMenu.classList.toggle('hidden');
})

const SideBarBtn = document.getElementById('sidebar-humberger')
const SideBar = document.getElementById('logo-sidebar')

SideBarBtn.addEventListener('click', function(){
    SideBar.classList.toggle('-translate-x-full')
})