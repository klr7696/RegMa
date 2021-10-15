import React from 'react'

const SidebarAdmin = () => {
    return ( 
        <div id="pcoded" className="pcoded">
    <div className="pcoded-overlay-box"></div>
    <div className="pcoded-container navbar-wrapper">
        <div className="pcoded-wrapper">
        <nav className="pcoded-navbar">
          <div className="pcoded-inner-navbar main-menu">
         <div className="pcoded-navigatio-lavel">
          <i className="feather icon-home">
            ACCEUIL </i></div >
          <ul className="pcoded-item pcoded-left-item">
            <li className="pcoded">
              <a type="button" href="#/admin/profils" >
                <span className="pcoded-micon"><i className="feather icon-users"/></span>
                <span className="pcoded-mtext">Profils</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/admin/mairie" >
                <span className="pcoded-micon"><i className="feather icon-home"/></span>
                <span className="pcoded-mtext">Mairie</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/admin/tableau-bord" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">Tableau de bord</span>
              </a>
              </li>
         </ul>
        </div>
        </nav>
      </div>
      </div>
    </div>
     );
}
 
export default SidebarAdmin;