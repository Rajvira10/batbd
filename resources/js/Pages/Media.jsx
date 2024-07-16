import React, { useState, useEffect } from "react";
import Layout from "../Components/Layout";
import { Pagination, Modal, Nav } from "react-bootstrap";
import axios from "axios";
import AccountNotVerified from "../Components/AccountNotVerified";

const Media = ({
    galleries,
    media: initialMedia,
    user,
    selectedGalleryId: initialGalleryId,
}) => {
    const [medias, setMedias] = useState(initialMedia);
    const [selectedGalleryId, setSelectedGalleryId] =
        useState(initialGalleryId);
    const [showModal, setShowModal] = useState(false);
    const [selectedImage, setSelectedImage] = useState(null);

    const fetchMedia = async (galleryId, page = 1) => {
        try {
            const response = await axios.get(
                `/gallery?page=${page}&gallery_id=${galleryId}`
            );
            setMedias(response.data);
        } catch (error) {
            console.error("Error fetching media:", error);
        }
    };

    const handlePageChange = (page) => {
        fetchMedia(selectedGalleryId, page);
    };

    const handleGalleryChange = (galleryId) => {
        setSelectedGalleryId(galleryId);
        fetchMedia(galleryId);
    };

    const handleImageClick = (image) => {
        setSelectedImage(image);
        setShowModal(true);
    };

    const handleClose = () => {
        setShowModal(false);
        setSelectedImage(null);
    };

    useEffect(() => {
        if (galleries.length > 0) {
            fetchMedia(selectedGalleryId);
        }
    }, [selectedGalleryId]);

    if (user.account_verified_at === null) {
        return (
            <Layout>
                <AccountNotVerified />
            </Layout>
        );
    }

    return (
        <Layout>
            <div className="container mt-4 media">
                <h2 className="mb-4">Gallery</h2>
                {galleries.length === 0 ? (
                    <div className="text-center w-100">
                        <h3>No galleries found</h3>
                    </div>
                ) : (
                    <>
                        <div className="nav-container">
                            <Nav variant="tabs" activeKey={selectedGalleryId}>
                                {galleries.map((gallery) => (
                                    <Nav.Item key={gallery.id}>
                                        <Nav.Link
                                            eventKey={gallery.id}
                                            onClick={() =>
                                                handleGalleryChange(gallery.id)
                                            }
                                        >
                                            {gallery.name}
                                        </Nav.Link>
                                    </Nav.Item>
                                ))}
                            </Nav>
                        </div>
                        <div className="row mt-4">
                            {medias?.data.map((item) => (
                                <div
                                    className="col-6 col-md-2 mb-4"
                                    key={item.id}
                                >
                                    <div
                                        className="card image-container"
                                        onClick={() => handleImageClick(item)}
                                    >
                                        <img
                                            src={item.relative_path}
                                            className="card-img-top"
                                            alt={item.title}
                                        />
                                    </div>
                                </div>
                            ))}
                            {medias?.data.length === 0 && (
                                <div className="text-center w-100">
                                    <h3>No media found</h3>
                                </div>
                            )}
                        </div>
                        <div className="d-flex justify-content-center mt-5">
                            {medias?.data.length !== 0 && (
                                <Pagination>
                                    <Pagination.First
                                        onClick={() => handlePageChange(1)}
                                        disabled={medias.current_page === 1}
                                    />
                                    <Pagination.Prev
                                        onClick={() =>
                                            handlePageChange(
                                                medias.current_page - 1
                                            )
                                        }
                                        disabled={medias.current_page === 1}
                                    />
                                    {[...Array(medias.last_page)].map(
                                        (_, index) => (
                                            <Pagination.Item
                                                key={index + 1}
                                                active={
                                                    index + 1 ===
                                                    medias.current_page
                                                }
                                                onClick={() =>
                                                    handlePageChange(index + 1)
                                                }
                                            >
                                                {index + 1}
                                            </Pagination.Item>
                                        )
                                    )}
                                    <Pagination.Next
                                        onClick={() =>
                                            handlePageChange(
                                                medias.current_page + 1
                                            )
                                        }
                                        disabled={
                                            medias.current_page ===
                                            medias.last_page
                                        }
                                    />
                                    <Pagination.Last
                                        onClick={() =>
                                            handlePageChange(medias.last_page)
                                        }
                                        disabled={
                                            medias.current_page ===
                                            medias.last_page
                                        }
                                    />
                                </Pagination>
                            )}
                        </div>
                    </>
                )}

                <Modal show={showModal} onHide={handleClose} centered>
                    <Modal.Header closeButton>
                        <Modal.Title>{selectedImage?.title}</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <img
                            src={selectedImage?.relative_path}
                            alt={selectedImage?.title}
                            className="img-fluid"
                        />
                    </Modal.Body>
                </Modal>
            </div>
        </Layout>
    );
};

export default Media;
