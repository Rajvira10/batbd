import { Link } from "@inertiajs/react";
import React, { useState } from "react";
import { CgClose } from "react-icons/cg";
import { GiHamburgerMenu } from "react-icons/gi";

const Navbar = () => {
    const currentUrl = window.location.href;
    const [mobileNavbar, showMobileNavbar] = useState(false);

    return (
        <header>
            <nav
                className="navbar navbar-expand-lg"
                style={{
                    backgroundColor: "#F5F5F5",
                    borderBottom: "2px solid white",
                }}
            >
                <div className="container-fluid">
                    <div className="header-container">
                        <Link className="navbar-brand" href="/">
                            <img
                                className="logo-lg"
                                src="/assets/images/logo-lg.png"
                                alt=""
                                srcSet=""
                                height={50}
                                width={161}
                            />
                        </Link>
                        <p className="ps-2">
                            Reconnect and Collaborate with Your Ex-Colleagues at
                            BAT BD
                        </p>
                    </div>
                    <div
                        className="hamburger"
                        onClick={() => {
                            showMobileNavbar(true);
                        }}
                    >
                        <GiHamburgerMenu
                            style={{ fontSize: "30px", cursor: "pointer" }}
                        />
                    </div>

                    <div className="collapse navbar-collapse" id="navbarNav">
                        <ul className="navbar-nav ms-auto">
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl === "/" ? "active" : ""
                                    }`}
                                    aria-current="page"
                                    href="/"
                                >
                                    My Profile
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/members")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/members"
                                >
                                    Members
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/news")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/news"
                                >
                                    News
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/gallery")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/gallery"
                                >
                                    Gallery
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/disclosures")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/disclosures"
                                >
                                    Disclosures
                                </Link>
                            </li>

                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/contact")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/contact"
                                >
                                    Contact
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div className={`mobile-navbar ${mobileNavbar && "show"}`}>
                        <div className="mobile-navbar-container">
                            <div
                                className="cross"
                                onClick={() => showMobileNavbar(false)}
                            >
                                <CgClose
                                    style={{
                                        position: "absolute",
                                        top: "20px",
                                        left: "20px",
                                        color: "white",
                                        fontSize: "30px",
                                        cursor: "pointer",
                                    }}
                                />
                            </div>
                            <Link
                                className={`nav-link ${
                                    currentUrl === "/" ? "active" : ""
                                }`}
                                aria-current="page"
                                href="/"
                            >
                                My Profile
                            </Link>
                            <Link
                                className={`nav-link ${
                                    currentUrl.includes("/members")
                                        ? "active"
                                        : ""
                                }`}
                                href="/members"
                            >
                                Members
                            </Link>
                            <Link
                                className={`nav-link ${
                                    currentUrl.includes("/news") ? "active" : ""
                                }`}
                                href="/news"
                            >
                                News
                            </Link>
                            <Link
                                className={`nav-link ${
                                    currentUrl.includes("/gallery")
                                        ? "active"
                                        : ""
                                }`}
                                href="/gallery"
                            >
                                Gallery
                            </Link>
                            <Link
                                className={`nav-link ${
                                    currentUrl.includes("/disclosures")
                                        ? "active"
                                        : ""
                                }`}
                                href="/disclosures"
                            >
                                Disclosures
                            </Link>
                            <Link
                                className={`nav-link ${
                                    currentUrl.includes("/contact")
                                        ? "active"
                                        : ""
                                }`}
                                href="/contact"
                            >
                                Contact
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    );
};

export default Navbar;
