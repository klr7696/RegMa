import React from 'react'

const SidebarSco = () => {
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
              <a type="button" href="#/sco/contrat" >
                <span className="pcoded-micon"><i className="feather icon-book"/></span>
                <span className="pcoded-mtext">Contrat</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sco/bon-commande" >
                <span className="pcoded-micon"><i className="feather icon-home"/></span>
                <span className="pcoded-mtext">Bon de commande</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sco/item-commande" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">Item de commande</span>
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
 
export default SidebarSco;