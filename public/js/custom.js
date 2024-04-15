var entries = 10;
var page = 1;
var sorting = {
        sortBy: "",
        sortDir: "asc"
    };

$(document).ready(function() {
    activeTab();
    entries = 10;
    page = 1;
    sorting.sortBy = "";
    sortDir = "asc";

    // pagination
    if ($('#entries').length) {
      $('#page_1').addClass('active');
    }
});

function activeTab() {
    // find current page
    let path = window.location.pathname;
    path = path.replace(/^\/|\/$/g, '');
    let sections = path.split('/');

    let tab = $('#nav_' + sections[0]);

    if (tab.length) {
        tab.addClass('active');
        tab.addClass('bg-gradient-primary');
    }
}

/* Pagination */
function changePage(page) {
  $('.pagination a').removeClass('active');
  $('#page_'+page).addClass('active');
};

/* Filter */
function getQueryParams(sorting = null) {
  let queryParams = new URLSearchParams(window.location.search);
  queryParams.set('company_id', $("#company_id").val());
  queryParams.set('start_date', $("#start_date").val());
  queryParams.set('end_date', $("#end_date").val());

  if (sorting)
  {
    queryParams.set('sort_by', sorting.sortBy);
    queryParams.set('sort_dir', sorting.sortDir);
  }

  return queryParams.toString();
}

/* Sorting */
function onSorting(obj) {
  let sortBy = obj.data('column');
  let sortDir = 'asc';
  
  if (obj.hasClass('active')) 
  {
      sortDir = 'asc';
      obj.removeClass('active');
  } 
  else 
  {
      sortDir = 'desc';
      obj.addClass('active');
  }

  return { sortBy: sortBy, sortDir: sortDir };
}

/* Fixed Filter */
if (document.querySelector('.fixed-filter')) {
  var fixedFilter = document.querySelector('.fixed-filter');
  var fixedFilter = document.querySelector('.fixed-filter');
  var fixedFilterButton = document.querySelector('.fixed-filter-button');
  var fixedFilterButtonNav = document.querySelector('.fixed-filter-button-nav');
  var fixedFilterCard = document.querySelector('.fixed-filter .card');
  var fixedFilterCloseButton = document.querySelectorAll('.fixed-filter-close-button');
  var navbar = document.getElementById('navbarBlur');
  var buttonNavbarFixed = document.getElementById('navbarFixed');

  if (fixedFilterButton) {
    fixedFilterButton.onclick = function() {
      if (!fixedFilter.classList.contains('show')) {
        fixedFilter.classList.add('show');
      } else {
        fixedFilter.classList.remove('show');
      }
    }
  }

  if (fixedFilterButtonNav) {
    fixedFilterButtonNav.onclick = function() {
      if (!fixedFilter.classList.contains('show')) {
        fixedFilter.classList.add('show');
      } else {
        fixedFilter.classList.remove('show');
      }
    }
  }

  fixedFilterCloseButton.forEach(function(el) {
    el.onclick = function() {
      fixedFilter.classList.remove('show');
    }
  })

  document.querySelector('body').onclick = function(e) {
    if (e.target != fixedFilterButton && e.target != fixedFilterButtonNav && e.target.closest('.fixed-filter .card') != fixedFilterCard) {
      fixedFilter.classList.remove('show');
    }
  }

  if (navbar) {
    if (navbar.getAttribute('data-scroll') == 'true' && buttonNavbarFixed) {
      buttonNavbarFixed.setAttribute("checked", "true");
    }
  }
}