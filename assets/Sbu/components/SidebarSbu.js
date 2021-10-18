import React from 'react'

const SidebarSbu = () => {
    return ( 
        <div id="pcoded" className="pcoded">
    <div className="pcoded-overlay-box"></div>
    <div className="pcoded-container navbar-wrapper">
        <div className="pcoded-wrapper">
        <nav className="pcoded-navbar">
          <div className="pcoded-inner-navbar main-menu">
          <div className="pcoded-navigatio-lavel">
          <i className="feather icon-home">
            ACCEUIL </i></div>
          <ul className="pcoded-item pcoded-left-item">
            <li className="pcoded">
              <a type="button" href="#/sbu/exercice" >
                <span className="pcoded-micon"><i className="feather icon-layers"/></span>
                <span className="pcoded-mtext">EXERCICE</span>
              </a>
              </li>
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-plus-square" /></span>
                <span className="pcoded-mtext">PREVISION</span>
              </a>
              <ul className="pcoded-submenu">
              <li className="">
                <a href="#/sbu/financement">
                <i className="feather icon-briefcase"></i>
                  <span className="pcoded-mtext">Ressource financière</span>
                </a>
              </li>
              <li >
                <a href="#/sbu/credit-ouvert">
                <i className="feather icon-menu"></i> 
                  <span className="pcoded-mtext">Crédit ouvert</span>
                </a>
              </li>
              <li >
                <a href="#/sbu/allocation">
                <i className="feather icon-navigation"></i> 
                  <span className="pcoded-mtext">Allocation</span>
                </a>
              </li>
        </ul>
        </li>
        <li className="pcoded">
              <a type="button" href="#/sbu/bailleur">
                <span className="pcoded-micon"><i className="feather icon-users"></i></span>
                <span className="pcoded-mtext"> BAILLEURS FONDS</span>
              </a>
          </li>
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-book"></i></span>
                <span className="pcoded-mtext">NOMENCLATURE</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/sbu/nomenclature">
                  <i className="feather icon-edit"></i>
                    <span className="pcoded-mtext">Création</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/sbu/compte-nature">
                  <i className="feather icon-sidebar"/> 
                    <span className="pcoded-mtext">Compte de nature</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/sbu/compte-fonction">
                  <i className="feather icon-sidebar"/> 
                    <span className="pcoded-mtext">Compte de fonction</span>
                  </a>
                </li>
          </ul>
          </li>
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-list"></i></span>
                <span className="pcoded-mtext">CONSULTER REGISTRE</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/livre/new">
                  <i className="feather icon-edit"></i>
                    <span className="pcoded-mtext"> A</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">B</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">C</span>
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
 
export default SidebarSbu;