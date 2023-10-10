import React, { useState, useEffect } from 'react';

const ProductForm = ({ onSubmit, onCancel, editedProduct }) => {
    const [nomProduit, setNomProduit] = useState('');
    const [descriptionProduit, setDescriptionProduit] = useState('');
    const [prixProduit, setPrixProduit] = useState(0);
    const [tvaProduit, setTvaProduit] = useState(0);
    const [refProduit, setRefProduit] = useState('');
    const [isOnline, setIsOnline] = useState(true);
    const [fournisseur, setFournisseur] = useState('');
    const [categories, setCategories] = useState([]);

    const [fournisseurs, setFournisseurs] = useState([]);
    const [categoriesList, setCategoriesList] = useState([]);

    useEffect(() => {
        if (editedProduct) {
            setNomProduit(editedProduct.nomProduit);
            setDescriptionProduit(editedProduct.descriptionProduit);
            setPrixProduit(editedProduct.prixProduit);
            setTvaProduit(editedProduct.tvaProduit);
            setRefProduit(editedProduct.refProduit);
            setIsOnline(editedProduct.isOnline);
            setFournisseur(editedProduct.fournisseur ? editedProduct.fournisseur.id : '');
            setCategories(editedProduct.categories.map(category => category.id));
        }

        fetch('https://nathan.amorce.org/api/fournisseurs')
            .then(response => response.json())
            .then(data => {
                setFournisseurs(data['hydra:member']);
            })
            .catch(error => {
                console.log('Erreur lors de la récupération des fournisseurs:', error);
            });

        fetch('https://nathan.amorce.org/api/categories', { headers: { "Accept": "application/json" } })
            .then(response => response.json())
            .then(data => {
                setCategoriesList(data);
            })
            .catch(error => {
                console.log('Erreur lors de la récupération des catégories:', error);
            });
    }, [editedProduct]);

    const handleFormSubmit = e => {
        e.preventDefault();
        const product = {
            nomProduit,
            descriptionProduit,
            prixProduit,
            tvaProduit,
            refProduit,
            isOnline,
            fournisseur: fournisseur ? `/api/fournisseurs/${fournisseur}` : '',
            categories: categories.map(category => `/api/categories/${category}`),
        };

        onSubmit(product);
        resetForm();
    };


    const handleCategoryChange = (e, categoryId) => {
        const isChecked = e.target.checked;
        let updatedCategories = [];

        if (isChecked) {
            updatedCategories = [...categories, categoryId];
        } else {
            updatedCategories = categories.filter(category => category !== categoryId);
        }

        setCategories(updatedCategories);
    };

    const resetForm = () => {
        setNomProduit('');
        setDescriptionProduit('');
        setPrixProduit(0);
        setTvaProduit(0);
        setRefProduit('');
        setIsOnline(true);
        setFournisseur('');
        setCategories([]);
    };

    return (
        <form onSubmit={handleFormSubmit}>
            <div>
                <label>Nom du produit:</label>
                <input type="text" value={nomProduit} onChange={e => setNomProduit(e.target.value)} />
            </div>
            <div>
                <label>Description du produit:</label>
                <input
                    type="text"
                    value={descriptionProduit}
                    onChange={e => setDescriptionProduit(e.target.value)}
                />
            </div>
            <div>
                <label>Prix du produit:</label>
                <input type="number" value={prixProduit} onChange={e => setPrixProduit(Number(e.target.value))} />
            </div>
            <div>
                <label>TVA du produit:</label>
                <input type="number" value={tvaProduit} onChange={e => setTvaProduit(Number(e.target.value))} />
            </div>
            <div>
                <label>Référence du produit:</label>
                <input type="text" value={refProduit} onChange={e => setRefProduit(e.target.value)} />
            </div>
            <div>
                <label>En ligne:</label>
                <input
                    type="checkbox"
                    checked={isOnline}
                    onChange={e => setIsOnline(e.target.checked)}
                />
            </div>
            <div>
                <label>Fournisseur:</label>
                <select value={fournisseur} onChange={e => setFournisseur(e.target.value)}>
                    <option value="">Sélectionnez un fournisseur</option>
                    {fournisseurs.map(fournisseur => (
                        <option key={fournisseur.id} value={fournisseur.id}>
                            {fournisseur.nomFournisseur}
                        </option>
                    ))}
                </select>
            </div>
            <div>
                <label>Catégories:</label>
                {categoriesList.map(category => (
                    <div key={category.id}>
                        <input type="checkbox" value={category.id} checked={categories.includes(category.id)} onChange={e => { handleCategoryChange(e, category.id)}}/>
                        <label>{category.nomCategorie}</label>
                    </div>
                ))}
            </div>
            <div>
                <button type="submit">Valider</button>
                <button type="button" onClick={onCancel}>
                    Annuler
                </button>
            </div>
        </form>
    );
};

export default ProductForm;