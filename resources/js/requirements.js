Livewire.on("confirmDelete", (id) => {
    const proceed = confirm(`Are you sure you want to delete this requirement`);

    if (proceed) {
        Livewire.emit("delete", id);
    }
});