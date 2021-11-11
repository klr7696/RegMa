import React from 'react'

const HeaderSco = () => {
    return ( 
      <nav className="navbar header-navbar pcoded-header">
      <div className="navbar-wrapper">
      <div className="navbar-logo">
      <a className="mobile-menu" id="mobile-collapse">
        <i className="feather icon-menu" />
      </a>
      <a href="#/home">
        <img className="img-fluid" src="assets/images/logo3.png" alt="Theme-Logo" width="55%" />
      </a>
      <a className="mobile-options">
        <i className="feather icon-more-horizontal" />
      </a>
    </div>
    <div className="navbar-container container-fluid">
      <ul className="nav-left">
        <li>
        <a >
          <i className="feather icon-user" />
        </a>
      </li>
      <li>
      <a  >
       Service des Contrats
      </a>
    </li>
  
  
      </ul>
      <ul className="nav-right">
        <li className="user-profile header-notification">
          <div className="dropdown-primary dropdown">
            <div className="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/images/admin1.png" className="img-radius" alt="User-Profile-Image" />
              <span>Sco</span>
              <i className="feather icon-chevron-down" />
            </div>
            <ul className="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
            <li>
            <a href="user-profile.htm">
              <i className="feather icon-user" /> Profil
            </a>
          </li>
            <li>
              <a href="#!">
                <i className="feather icon-settings" /> Paramètre
              </a>
            </li>
            <li>
              <a href="auth-lock-screen.htm">
                <i className="feather icon-lock" /> Vérouiller
              </a>
            </li>
            <li>
              <a href="auth-normal-sign-in.htm">
                <i className="feather icon-log-out" /> Déconnecter
              </a>
            </li>
            </ul>
          </div>
        </li>
      </ul>
      </div>
      </div>
  </nav>
     );
}
 
export default HeaderSco;