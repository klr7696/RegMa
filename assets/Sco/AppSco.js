import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderSco from './components/HeaderSco';
import SidebarSco from './components/SidebarSco';
import ConsultBon from './pages/BonCommande/ConsultBon';
import InscriBon from './pages/BonCommande/InscriBon';
import ConsultCommission from './pages/Commission/ConsultCommission';
import InscriCommission from './pages/Commission/InscriCommission';
import ConsultContrat from './pages/Contrat/ConsultContrat';
import InscriContrat from './pages/Contrat/InscriContrat';
import ConsultItem from './pages/ItemCommande/ConsultItem';
import InscriItem from './pages/ItemCommande/InscriItem';
import ConsultMembre from './pages/Membre/ConsultMembre';
import InscriMembre from './pages/Membre/InscriMembre';
import ConsultParticipant from './pages/Participant/ConsultParticipant';
import InscriParticipant from './pages/Participant/InscriParticipant';

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
                       <Route
                        path={`${this.props.match.url}/commission/:id`}
                        component={InscriCommission}
                      />
                      <Route
                        path={`${this.props.match.url}/commission`}
                        component={ConsultCommission}
                      />
                       <Route
                        path={`${this.props.match.url}/membre/:id`}
                        component={InscriMembre}
                      />
                      <Route
                        path={`${this.props.match.url}/membre`}
                        component={ConsultMembre}
                      />
                       <Route
                        path={`${this.props.match.url}/participant/:id`}
                        component={InscriParticipant}
                      />
                      <Route
                        path={`${this.props.match.url}/participant`}
                        component={ConsultParticipant}
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
