
// MENU
let menu = document.querySelector('.menu');
let sidebar = document.querySelector('.sidebar');
let content = document.querySelector('.content');
menu.onclick = function(){
    sidebar.classList.toggle('on');
    content.classList.toggle('on');
}

// USER ICON
let submenu = document.querySelector('.submenu-wrap');
let usr = document.querySelector('#usericon');
usr.onclick = function(){
    submenu.classList.toggle('open');
}

// SEARCH BAR
const searchInput = document.querySelector("#searchBar");
const tableRows = document.querySelectorAll(".tr ");

searchInput.addEventListener("input", filterTable);

function filterTable(e) {
  const searchText = e.target.value.toLowerCase();

  tableRows.forEach((row) => {
    const rowData = row.textContent.toLowerCase();
    if (rowData.includes(searchText)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}