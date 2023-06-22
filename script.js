// Adds the class 'active_dashboard_option' to add style using css

let dashboard_options = document.querySelectorAll(".dashboard_options");
let dashboard_content = document.querySelectorAll(".dashboard_content");

dashboard_options.forEach((option, index) => {
  option.addEventListener("click", function () {
    dashboard_options.forEach((option) => {
      option.classList.remove("active_dashboard_option");
    });

    this.classList.add("active_dashboard_option");
    dashboard_content.forEach((section) => {
      section.style.display = "none";
    });
    dashboard_content[index].style.display = "block";
  });
});

dashboard_options[0].classList.add("active_dashboard_option");

// Shows 'dashboard' content and hides the others options's content

dashboard_content.forEach((section, index) => {
  if (index === 0) {
    section.style.display = "block";
  } else {
    section.style.display = "none";
  }
});