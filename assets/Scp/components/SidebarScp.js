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
                <span className="pcoded-micon"><i className="icofont icofont-architecture-alt"></i></span>
                <span className="pcoded-mtext">Planification</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/scp/plan/new">
                  <i className="fa fa-wpforms"></i>
                    <span className="pcoded-mtext">Plan de passation</span>
                  </a>
                </li>

                <li className="">
                  <a href="#/scp/lot-marche">
                  <i className="fa fa-shopping-bag"></i>
                    <span className="pcoded-mtext">Lot de Marché</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/exception-marche">
                  <i className="fa fa-crosshairs"></i>
                    <span className="pcoded-mtext">Exception de Marché</span>
                  </a>
                </li>
          </ul>
          </li>
    
<li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="icofont icofont-files"></i></span>
                <span className="pcoded-mtext">Projets</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/scp/projet-marche/new">
                  <i className="fa fa-minus-square-o"></i>
                    <span className="pcoded-mtext">Projet de Marché</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/activite-projet/new">
                  <i className="feather icon-list"></i>
                    <span className="pcoded-mtext">Activité du projet</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/decision-marche/new">
                  <i className="fa fa-legal"></i>
                    <span className="pcoded-mtext">Decision de marché</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/mode-passation/new">
                  <i className="fa fa-mail-forward"></i>
                    <span className="pcoded-mtext">Mode de passation</span>
                  </a>
                </li> 
               
          </ul>
          </li>
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="fa fa-file-text"></i></span>
                <span className="pcoded-mtext">Soumissions</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/scp/soumissionaire/new">
                  <i className="fa fa-male"></i>
                    <span className="pcoded-mtext">Soumissionaire</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/soumission/new">
                  <i className="fa fa-list-alt"></i>
                    <span className="pcoded-mtext">Soumission</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/offre-marche/new">
                  <i className="fa fa-envelope-o"></i>
                    <span className="pcoded-mtext">Offre de marche</span>
                  </a>
                </li>
          </ul>
          </li>
        
          <li className="pcoded-hasmenu">
              <a type="button" href="#" onClick={e => e.preventDefault()}>
                <span className="pcoded-micon"><i className="icofont icofont-company"></i></span>
                <span className="pcoded-mtext">Commissions</span>
              </a>
              <ul className="pcoded-submenu">
                <li className="">
                  <a href="#/scp/membre/new">
                  <i className="icofont icofont-businessman"></i>
                    <span className="pcoded-mtext">Membre</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/commission/new">
                  <i className="icofont icofont-company"></i>
                    <span className="pcoded-mtext">Commission</span>
                  </a>
                </li>
                <li className="">
                  <a href="#/scp/participant/new">
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
 
export default SidebarScp;