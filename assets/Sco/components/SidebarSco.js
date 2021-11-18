import React from 'react'

const SidebarSco = () => {
    return ( 
        <div id="pcoded" className="pcoded">
    <div className="pcoded-overlay-box"></div>
    <div className="pcoded-container navbar-wrapper">
        <div className="pcoded-wrapper">
        <nav className="pcoded-navbar">
          <div className="pcoded-inner-navbar main-menu">
         
          <ul className="pcoded-item pcoded-left-item">
           <li className="">
                  <a href="#/scp/lot-marche">
                  <i className="fa fa-shopping-bag"></i>
                    <span className="pcoded-mtext">ACCEUIL</span>
                  </a>
                </li>
            <li className="pcoded">
              <a type="button" href="#/sco/contrat/new" >
                <span className="pcoded-micon"><i className="feather icon-book"/></span>
                <span className="pcoded-mtext">Contrat</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sco/bon-commande/new" >
                <span className="pcoded-micon"><i className="feather icon-home"/></span>
                <span className="pcoded-mtext">Bon de commande</span>
              </a>
              </li>
              <li className="pcoded">
              <a type="button" href="#/sco/item-commande/new" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">Item de commande</span>
              </a>
              </li>
              <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="icofont icofont-company"></i></span>
                <span className="pcoded-mtext">Commissions</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/sco/membre/new">
                  <i className="icofont icofont-businessman"></i>
                    <span className="pcoded-mtext">Membre</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/sco/commission/new">
                  <i className="icofont icofont-company"></i>
                    <span className="pcoded-mtext">Commission</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/sco/participant/new">
                  <i className="icofont icofont-businessman"></i>
                    <span className="pcoded-mtext">Participant</span>
                  </a>
                </li>
          </ul>
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