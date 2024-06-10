import { useDispatch, useSelect } from '@wordpress/data';
import { store } from '@wordpress/notices';
import { NoticeList } from '@wordpress/components';

const Notices = () => {

    const { removeNotice } = useDispatch( store );

    const notices = useSelect( ( select ) =>
        select( store ).getNotices()
    );

    if ( notices.length === 0 ) {
        return null;
    }

    return <NoticeList notices={ notices } onRemove={ removeNotice } />;
};
export default Notices;
