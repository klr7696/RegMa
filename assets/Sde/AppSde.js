import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';
import HeaderSde from './components/HeaderSde';
import SidebarSde from './components/SidebarSde';
import ConsultFonction from './pages/comptesFonction/ConsultFonction';
import InscriClasse from './pages/comptesFonction/InscriClasse';
import InscriDivision from './pages/comptesFonction/InscriDivision';
import InscriGroupe from './pages/comptesFonction/InscriGroupe';
import ConsultEngagement from './pages/Engagement/ConsultEngagement';
import InscriEngagement from './pages/Engagement/InscriEngagement';
import ConsultImputation from './pages/Imputation/ConsultImputation';
import InscriImputation from './pages/Imputation/InscriImputation';
import ConsultMandatement from './pages/Mandatement/ConsultMandatement';
import InscriMandatement from './pages/Mandatement/InscriMandatement';
import ConsultOperation from './pages/OperationDepense/ConsultOperation';
import InscriOperation from './pages/OperationDepense/InscriOperation';


class AppSde extends Component {
  render() {
    return (
      <div id="pcoded" className="pcoded">
        <div className="pcoded-container navbar-wrapper">
          <HeaderSde />
          <div className="pcoded-main-container">
            <div className="pcoded-wrapper">
              <SidebarSde />
              <div className="pcoded-content">
                <div className="pcoded-inner-content">
                  <div className="main-body">
                    <Switch>
                      <Route
                        path={`${this.props.match.url}/engagement/:id`}
                        component={InscriEngagement}
                      />
                       <Route
                        path={`${this.props.match.url}/engagement`}
                        component={ConsultEngagement}
                      />
                       <Route
                        path={`${this.props.match.url}/imputation/:id`}
                        component={InscriImputation}
                      />
                       <Route
                        path={`${this.props.match.url}/imputation`}
                        component={ConsultImputation}
                      />
                       <Route
                        path={`${this.props.match.url}/mandatement/:id`}
                        component={InscriMandatement}
                      />
                       <Route
                        path={`${this.props.match.url}/mandatement`}
                        component={ConsultMandatement}
                      />
                      <Route
                        path={`${this.props.match.url}/operation/:id`}
                        component={InscriOperation}
                      />
                       <Route
                        path={`${this.props.match.url}/operation`}
                        component={ConsultOperation}
                      />
                      <Route
                        path={`${this.props.match.url}/classe/:id`}
                        component={InscriClasse}
                      />
                       <Route
                        path={`${this.props.match.url}/division/:id`}
                        component={InscriDivision}
                      />
                       <Route
                        path={`${this.props.match.url}/groupe/:id`}
                        component={InscriGroupe}
                      />
                       <Route
                        path={`${this.props.match.url}/compte-fonction`}
                        component={ConsultFonction}
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

export default withRouter(AppSde);
