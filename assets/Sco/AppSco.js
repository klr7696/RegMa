import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderSco from './components/HeaderSco';
import SidebarSco from './components/SidebarSco';
import BonCommande from './pages/BonCommande';
import ConsultBon from './pages/BonCommande/ConsultBon';
import InscriBon from './pages/BonCommande/InscriBon';
import Contrat from './pages/Contrat';
import ConsultContrat from './pages/Contrat/ConsultContrat';
import InscriContrat from './pages/Contrat/InscriContrat';
import ItemCommande from './pages/ItemCommande';
import ConsultItem from './pages/ItemCommande/ConsultItem';
import InscriItem from './pages/ItemCommande/InscriItem';

class AppSco extends Component {
  render() {
    return (
      <div id="pcoded" className="pcoded">
        <div className="pcoded-container navbar-wrapper">
          <HeaderSco />
          <div className="pcoded-main-container">
            <div className="pcoded-wrapper">
              <SidebarSco />
              <div className="pcoded-content">
                <div className="pcoded-inner-content">
                  <div className="main-body">
                    <Switch>
                      <Route
                        path={`${this.props.match.url}/contrat/:id`}
                        component={InscriContrat}
                      />
                       <Route
                        path={`${this.props.match.url}/contrat`}
                        component={ConsultContrat}
                      />
                       <Route
                        path={`${this.props.match.url}/bon-commande/:id`}
                        component={InscriBon}
                      />
                       <Route
                        path={`${this.props.match.url}/bon-commande`}
                        component={ConsultBon}
                      />
                      <Route
                        path={`${this.props.match.url}/item-commande/:id`}
                        component={InscriItem}
                      />
                      <Route
                        path={`${this.props.match.url}/item-commande`}
                        component={ConsultItem}
                      />
                    </Switch>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  );
}
}

export default withRouter(AppSco);
