import React from "react";
import Layout from "../Components/Layout";

const Disclosure = ({ disclosure }) => {
    return (
        <Layout>
            <div className="pt-5"></div>
            <div
                className=""
                style={{
                    width: "70%",
                    minHeight: "80vh",
                    margin: "0 auto",
                }}
            >
                <div className="card">
                    <div className="card-body">
                        <div className="row">
                            <div className="col-md-6 px-4">
                                <h5>Terms and Conditions</h5>
                                <br />
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: disclosure.terms_and_conditions,
                                    }}
                                />
                            </div>
                            <div className="border-start border-2 col-md-6 px-4">
                                <h5>Privacy Policy</h5>
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
