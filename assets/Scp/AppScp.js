import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderScp from './components/HeaderScp';
import SidebarScp from './components/SidebarScp';
import AcceuilSCP from './pages/AcceuilSCP';
import ConsultActivite from './pages/ActiviteProj/ConsultActivite';
import InscriActivite from './pages/ActiviteProj/InscriActivite';
import ConsultCommission from './pages/Commission/ConsultCommission';
import InscriCommission from './pages/Commission/InscriCommission';
import ConsultDecision from './pages/DecisionMarche/ConsultDecision';
import InscriDecision from './pages/DecisionMarche/InscriDecision';
import ConsultException from './pages/ExceptionMarche/ConsultExcept';
import InscriException from './pages/ExceptionMarche/InscriExcept';
import ConsultLot from './pages/LotMarche/ConsultLot';
import InscriLot from './pages/LotMarche/InscriLot';
import ConsultMembre from './pages/Membre/ConsultMembre';
import InscriMembre from './pages/Membre/InscriMembre';
import ConsultModeP from './pages/ModePassation/ConsultModeP';
import InscriModeP from './pages/ModePassation/InscriModeP';
import ConsultOffre from './pages/OffreMarche/ConsultOffre';
import InscriOffre from './pages/OffreMarche/InscriOffre';
import ConsultParticipant from './pages/Participant/ConsultParticipant';
import InscriParticipant from './pages/Participant/InscriParticipant';
import ConsultPlan from './pages/PlanPassation/ConsultPlan';
import InscriPlan from './pages/PlanPassation/InscriPlan';
import ConsultProjet from './pages/ProjetMarche/ConsultProjet';
import InscriProjet from './pages/ProjetMarche/InscriProjet';
import ConsultSoumission from './pages/Soumission/ConsultSoumission';
import InscriSoumission from './pages/Soumission/InscriSoumission';
import ConsultSoumissionaire from './pages/Soumissionaire/ConsultSoumissionaire';
import InscriSoumissionaire from './pages/Soumissionaire/InscriSoumissionaire';

class AppScp extends Component {
  render() {
    return (
      <div id="pcoded" className="pcoded">
        <div className="pcoded-container navbar-wrapper">
          <HeaderScp />
          <div className="pcoded-main-container">
            <div className="pcoded-wrapper">
              <SidebarScp />
              <div className="pcoded-content">
                <div className="pcoded-inner-content">
                  <div className="main-body">
                    <Switch>
                      <Route
                        path={`${this.props.match.url}/plan/:id`}
                        component={InscriPlan}
                      />
                       <Route
                        path={`${this.props.match.url}/plan`}
                        component={ConsultPlan}
                      />
                      <Route
                        path={`${this.props.match.url}/lot-marche/:id`}
                        component={InscriLot}
                      />
                      <Route
                        path={`${this.props.match.url}/lot-marche`}
                        component={ConsultLot}
                      />
                      <Route
                        path={`${this.props.match.url}/activite-projet/:id`}
                        component={InscriActivite}
                      />
                       <Route
                        path={`${this.props.match.url}/activite-projet`}
                        component={ConsultActivite}
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
                        path={`${this.props.match.url}/decision-marche/:id`}
                        component={InscriDecision}
                      />
                      <Route
                        path={`${this.props.match.url}/decision-marche`}
                        component={ConsultDecision}
                      />
                      <Route
                        path={`${this.props.match.url}/exception-marche/:id`}
                        component={InscriException}
                      />
                      <Route
                        path={`${this.props.match.url}/exception-marche`}
                        component={ConsultException}
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
                        path={`${this.props.match.url}/mode-passation/:id`}
                        component={InscriModeP}
                      />
                       <Route
                        path={`${this.props.match.url}/mode-passation`}
                        component={ConsultModeP}
                      />
                        <Route
                        path={`${this.props.match.url}/offre-marche/:id`}
                        component={InscriOffre}
                      />
                       <Route
                        path={`${this.props.match.url}/offre-marche`}
                        component={ConsultOffre}
                      />
                        <Route
                        path={`${this.props.match.url}/participant/:id`}
                        component={InscriParticipant}
                      />
                       <Route
                        path={`${this.props.match.url}/participant`}
                        component={ConsultParticipant}
                      />
                        <Route
                        path={`${this.props.match.url}/projet-marche/:id`}
                        component={InscriProjet}
                      />
                       <Route
                        path={`${this.props.match.url}/projet-marche`}
                        component={ConsultProjet}
                      />
                        <Route
                        path={`${this.props.match.url}/soumission/:id`}
                        component={InscriSoumission}
                      />
                       <Route
                        path={`${this.props.match.url}/soumission`}
                        component={ConsultSoumission}
                      />
                        <Route
                        path={`${this.props.match.url}/soumissionaire/:id`}
                        component={InscriSoumissionaire}
                      />
                       <Route
                        path={`${this.props.match.url}/soumissionaire`}
                        component={ConsultSoumissionaire}
                      />
                       <Route
                        path={`${this.props.match.url}`}
                        component={AcceuilSCP}
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

export default withRouter(AppScp);
