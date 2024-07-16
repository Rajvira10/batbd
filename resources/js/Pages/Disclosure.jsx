import React from "react";
import Layout from "../Components/Layout";

const Disclosure = ({ disclosure }) => {
    return (
        <Layout>
            <div className="pt-5"></div>
            <div className="site-container mb-5">
                <div className="card">
                    <div className="card-body">
                        <div className="row">
                            <div className="col-md-6 px-4">
                                <h5>Terms and Conditions</h5>
                                <hr />
                                <br />
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: disclosure.terms_and_conditions,
                                    }}
                                />
                            </div>
                            <div className="col-md-6 px-4 mobile-border">
                                <h5>Privacy Policy</h5>
                                <hr />
                                <br />
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: disclosure.privacy_policy,
                                    }}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    );
};

export default Disclosure;
