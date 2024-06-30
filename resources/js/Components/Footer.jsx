import React from "react";

const Footer = () => {
    return (
        <footer>
            <div
                style={{
                    textAlign: "center",
                    width: "65%",
                    margin: "0 auto",
                }}
            >
                <div className="row">
                    <div className="col-lg-4 mb-4 mb-lg-0">
                        <p className="footer-text fw-semibold">
                            © 2024 - <br /> Beyond BATBD. All rights reserved
                        </p>
                    </div>
                    <div className="col-lg-4 mb-4 mb-lg-0">
                        <p className="footer-text">
                            <span className="text-muted">Designed by</span>{" "}
                            <i>Intelligent Machines</i> <br />{" "}
                            <span className="text-muted">Built by</span>{" "}
                            <i>Webbly Solutions</i>
                        </p>
                    </div>
                    <div className="col-lg-4 mb-4">
                        <p className="footer-text">
                            <span className="fw-semibold">
                                Special thanks to
                            </span>{" "}
                            <br /> Shafayet Kamal Shiddiki
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
