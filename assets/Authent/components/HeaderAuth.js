import React from "react";

const HeaderAuth = () => {
  return (
    <nav className="header-navbar pcoded-header">
      <div className="navbar-wrapper">
        <div className="navbar-logo">
          <div className="dropdown-toggle" data-toggle="dropdown">
            <img
              className="img-fluid"
              src="assets/images/logo3.png"
              alt="Theme-Logo"
              width="55%"
            />
          </div>
          <ul
            className="show-notification notification-view dropdown-menu"
            data-dropdown-in="fadeIn"
            data-dropdown-out="fadeOut"
          >
            <img
              className="img-fluid"
              src="assets/images/logo3.png"
              alt="Theme-Logo"
              width="100%"
            />
          </ul>
        </div>
        <div className="navbar-container container-fluid">
          <ul className="nav-left">
            <li>
              <a>
                <i className="feather icon-book" />
                <span> Gestion des registres du Marché Public</span>

              </a>
            </li>
          </ul>
          <ul className="nav-right">
          
            <li className="profile-image">
            <a>
         Unité-Progrès-Justice
        </a>
                <a ><img
                  className="img-50"
                  src="..\assets\images\bf1.png"
                  alt="user-img"
                  width="27%"
                />
                </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default HeaderAuth;
