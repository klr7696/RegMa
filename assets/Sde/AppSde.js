import React from 'react';
import { Component } from 'react';
import { Route, Switch, withRouter } from 'react-router';


class AppSde extends Component {
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
                        path={`${this.props.match.url}/contrat`}
                        component={Contrat}
                      />
                       <Route
                        path={`${this.props.match.url}/bon-commande`}
                        component={BonCommande}
                      />
                      <Route
                        path={`${this.props.match.url}/item-commande`}
                        component={ItemCommande}
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
