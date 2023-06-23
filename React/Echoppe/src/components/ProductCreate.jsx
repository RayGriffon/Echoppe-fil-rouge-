import React, { useState } from 'react';
import ProductForm from './ProductForm';

const ProductCreate = ({ onSave, onCancel }) => {
    const [newProduct, setNewProduct] = useState({
        nomProduit: '',
        descriptionProduit: '',
        prixProduit: 0,
        tvaProduit: 0,
        refProduit: '',
        isOnline: true,
        fournisseur: '',
        categories: [],
    });

    const handleFormSubmit = () => {
        onSave(newProduct);
        resetForm();
    };

    const resetForm = () => {
        setNewProduct({
            nomProduit: '',
            descriptionProduit: '',
            prixProduit: 0,
            tvaProduit: 0,
            refProduit: '',
            isOnline: true,
            fournisseur: '',
            categories: [],
        });
    };

    return (
        <div>
            <h2>Créer un nouveau produit</h2>
            <ProductForm onSubmit={handleFormSubmit} onCancel={onCancel} editedProduct={null} />
        </div>
    );
};

export default ProductCreate;
