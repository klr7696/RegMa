import React from 'react'

const SidebarScp = () => {
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
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-list"></i></span>
                <span className="pcoded-mtext">Planification</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/scp/plan">
                  <i className="feather icon-edit"></i>
                    <span className="pcoded-mtext">Plan de passation</span>
                  </a>
                </li>

                <li className="">
                  <a href="#/scp/lot">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Lot de Marché</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Exception de Marché</span>
                  </a>
                </li>
          </ul>
          </li>
    
<li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-list"></i></span>
                <span className="pcoded-mtext">Projets</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/scp/projet">
                  <i className="feather icon-edit"></i>
                    <span className="pcoded-mtext">Projet de Marché</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Activité du projet</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Decision de marché</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Mode de passation</span>
                  </a>
                </li> 
               
          </ul>
          </li>
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-list"></i></span>
                <span className="pcoded-mtext">Soumissions</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/livre/new">
                  <i className="feather icon-edit"></i>
                    <span className="pcoded-mtext">Soumissionaire</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Soumission</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/offre">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Offre de marche</span>
                  </a>
                </li>
          </ul>
          </li>
        
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="feather icon-list"></i></span>
                <span className="pcoded-mtext">Commissions</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/livre/new">
                  <i className="feather icon-edit"></i>
                    <span className="pcoded-mtext">Membre</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Commission</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/livres/liste">
                  <i className="feather icon-list"></i>
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
 
export default SidebarScp;