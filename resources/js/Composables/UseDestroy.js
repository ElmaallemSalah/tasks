import { ref } from 'vue';
import Swal from 'sweetalert2';
import {

  useForm,
} from "@inertiajs/vue3";


export default function useDestroy() {

  const form = useForm({});
  const deleteResult = ref(null);

  const destroy = (routeName, id) => {
    Swal.fire({
      title: "Are you sure you want to Delete?",
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: "Yes, Delete it!",
      denyButtonText: `Don't Delete it!`
    }).then((result) => {
      if (result.isConfirmed) {
        // Assuming 'form' and 'route' are globally accessible objects or imported dependencies
        form.delete(route(routeName, id), {
          preserveState: true,
          preserveScroll: true,
        });
      }
    });
  };

  return { destroy, deleteResult };
}

