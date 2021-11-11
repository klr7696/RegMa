import React from 'react'

const SidebarSde = () => {
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
              <a type="button" href="#/sde/operation" >
                <span className="pcoded-micon"><i className="feather icon-book"/></span>
                <span className="pcoded-mtext">Operation de dépense</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sde/engagement" >
                <span className="pcoded-micon"><i className="feather icon-home"/></span>
                <span className="pcoded-mtext">Engagement</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sde/mandatement" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">Mandatement</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sde/imputation" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">Imputation de crédit</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sde/compte-fonction" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">Compte de fonction</span>
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
 
export default SidebarSde;