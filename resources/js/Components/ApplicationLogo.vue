<template>
    <div class="icon-container">
        <img src="/icon/financial-control.png" alt="Foto desde public" class="icon-img">
    </div>
</template>
<style>
.icon-container {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #474747;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, background-color 0.3s ease;
    margin: 15px;
    cursor: pointer;
}

.icon-img {
    width: 60%;
    height: 60%;
    object-fit: contain;
}
</style>
